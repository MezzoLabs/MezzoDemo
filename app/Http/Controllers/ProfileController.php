<?php


namespace App\Http\Controllers;


use App\Category;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\StoreLikedCategoriesRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\LikedCategoriesRepository;
use Auth;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Permission\PermissionGuard;
use MezzoLabs\Mezzo\Modules\Addresses\Domain\Repositories\AddressRepository;
use MezzoLabs\Mezzo\Modules\User\Domain\Repositories\UserRepository;

class ProfileController extends Controller
{
    /**
     * @var \App\User|null
     */
    protected $user;

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var LikedCategoriesRepository
     */
    protected $likedCategoriesRepository;

    /**
     * @var AddressRepository
     */
    protected $addresses;

    public function __construct(UserRepository $users, AddressRepository $addresses, LikedCategoriesRepository $likedCategoriesRepository)
    {
        $this->user = Auth::user();

        view()->share('user', $this->user);
        $this->users = $users;
        $this->addresses = $addresses;
        $this->likedCategoriesRepository = $likedCategoriesRepository;
    }

    public function profile()
    {
        return view('magazine.profile');
    }

    public function getAddress()
    {
        return view('magazine.profile.address');
    }

    public function updateUser(UpdateUserRequest $request)
    {
        mezzo_dd($request);
    }

    public function updatePassword(UpdateUserRequest $request)
    {
        $this->users->update(['password' => bcrypt($request->get('password'))], $this->user->id);

        return redirect()->back()->with('message', 'Password changed.');
    }

    public function storeAddress(StoreAddressRequest $request)
    {
        $address = $this->addresses->create($request->all());

        $this->user->address_id = $address->id;
        $this->user->save();

        return redirect()->back()->with('message', 'New address stored');
    }

    public function updateAddress(\App\Http\Requests\UpdateAddressRequest $request)
    {
        $this->addresses->update($request->all(), $this->user->address->id);

        return redirect()->back()->with('message', 'Address updated');
    }

    public function getLikedCategories()
    {
        $all = Category::inGroup('content')->get()->toTree();

        return view(
            'magazine.profile.liked_categories', [
            'categories' => [
                'all' => $all
            ]
        ]);
    }

    public function storeLikedCategories(StoreLikedCategoriesRequest $request)
    {
        $liked = (new Collection($request->get('categories')))->keys();

        $this->likedCategoriesRepository->unsetBaseValues($this->user);

        foreach ($liked as $categoryId) {
            $category = Category::findOrFail($categoryId);
            $this->likedCategoriesRepository->like($category);
        }

        return redirect()->back()->with('message', 'Liked categories updated.');

    }

    public function destroy()
    {
        PermissionGuard::setActive(false);
        $this->users->delete($this->user->id);
        PermissionGuard::setActive(true);

        return redirect('/')->with('message', 'Good bye');
    }
}