<?php


namespace App\Http\Controllers;


use App\Category;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\StoreLikedCategoriesRequest;
use App\Http\Requests\UpdateAddressRequest;
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
     * @var AddressRepository
     */
    protected $addresses;

    public function __construct(UserRepository $users, AddressRepository $addresses)
    {
        $this->user = Auth::user();

        view()->share('user', $this->user);
        $this->users = $users;
        $this->addresses = $addresses;
    }

    public function profile()
    {
        return view('magazine.profile');
    }

    public function getAddress()
    {
        return view('magazine.profile.address');
    }

    public function storeAddress(StoreAddressRequest $request)
    {

        $address = $this->addresses->create($request->all());

        $this->user->address_id = $address->id;
        $this->user->save();

        return redirect()->back()->with('message', 'New address stored');
    }

    public function updateAddress(UpdateAddressRequest $request)
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
                'all' => $all,
                'liked' => []
            ]
        ]);
    }

    public function storeLikedCategories(StoreLikedCategoriesRequest $request)
    {
        $liked = (new Collection($request->get('categories')))->keys();


    }

    public function destroy()
    {
        PermissionGuard::setActive(false);
        $this->users->delete($this->user->id);
        PermissionGuard::setActive(true);

        return redirect('/')->with('message', 'Good bye');
    }
}