class TestMainController {

    /*@ngInject*/ constructor($http){
        /*
        $http.get('/api/tutorials', {
            headers: {
                Accept: 'application/vnd.MezzoLabs.v1+json'
            }
        }).success(data => {
            console.log(data);
        }).error(err => {
            console.error(err);
        });
        */

        this.models = [{"id":2, "title":"Placeat ut placeat tempore a.", "body":"Delectus libero vitae quae nesciunt ipsa soluta in sed. Dolores sit voluptatem perferendis qui quo aliquam adipisci. Rerum nobis aliquid fugiat est. Repudiandae sint sunt qui.", "user_id":29, "parent":0},
            {"id":3, "title":"Aut dolor id eum quae et eos.", "body":"Tempora cupiditate eos sint sequi nihil non porro. Perferendis voluptas et dicta qui omnis. Sed omnis dolor deserunt. Ipsa ad libero voluptates labore totam exercitationem et consequatur.", "user_id":15, "parent":0},
            {"id":4, "title":"Ut sed quo veritatis aut.", "body":"Corporis ex nemo dignissimos distinctio. Laboriosam libero quam sed labore. Fuga delectus ullam omnis harum delectus quia et. Illo saepe possimus rerum deleniti.", "user_id":32, "parent":0},
            {"id":5, "title":"Et nisi quis eum dignissimos.", "body":"Odit voluptas similique autem sint. Similique vitae eaque illo possimus. Eos deserunt ut laborum reprehenderit eaque accusantium ipsa. Eveniet labore quas velit ipsum.", "user_id":26, "parent":0},
            {"id":6, "title":"Nihil modi officia et et.", "body":"Nam doloremque et esse velit. In voluptates laborum fugit rerum. Iste possimus totam cupiditate. Aut qui tempora sit rem.", "user_id":4, "parent":0},
            {"id":7, "title":"Qui aliquam iusto illum ipsa.", "body":"Sit modi quia accusamus amet hic odit. Dolore ut illum id et amet impedit sed. Eum optio id eum nesciunt consequatur quo. Quam eos quidem consequuntur blanditiis.", "user_id":11, "parent":0},
            {"id":8, "title":"Ratione id eveniet possimus.", "body":"Amet odit pariatur quo. Voluptatem molestias ut qui ab ut. Aspernatur quam occaecati eveniet et.", "user_id":3, "parent":0},
            {"id":9, "title":"Eligendi quae aut voluptas.", "body":"Inventore corrupti vero deleniti cumque et voluptate et. Qui saepe assumenda voluptates nihil adipisci reprehenderit. Nisi reprehenderit soluta dolorum.", "user_id":23, "parent":0},
            {"id":10, "title":"Quae quia enim omnis.", "body":"Fugiat assumenda aut ea et reprehenderit neque. Impedit numquam ut sed aperiam.", "user_id":34, "parent":0},
            {"id":11, "title":"Ab numquam a tempora autem.", "body":"Repellendus explicabo ut omnis numquam culpa ea. Non eum placeat illo ipsam magni consequatur. Enim quas illum perferendis.\nAd excepturi cum molestiae magni. Voluptatum tempora totam ut unde.", "user_id":9, "parent":0},
            {"id":12, "title":"Qui sint porro est non.", "body":"Eos sapiente sed voluptatibus impedit nulla. Voluptatem eos dolore nobis facilis sapiente vel possimus adipisci. Doloremque sapiente quis a et quam.", "user_id":8, "parent":0},
            {"id":13, "title":"Et reiciendis fugiat et quo.", "body":"Qui voluptas aut qui modi fugiat voluptatum sapiente. Earum ut et nihil aut dolorem. Praesentium aut unde et quidem natus adipisci aut. Amet et quam est necessitatibus.", "user_id":21, "parent":0},
            {"id":14, "title":"Omnis unde in sint est.", "body":"Non sunt est non blanditiis est in. Corporis voluptas et voluptatem consequuntur. Vel aliquam fugit ratione neque tempore.", "user_id":16, "parent":0},
            {"id":15, "title":"Corporis aut qui est.", "body":"Quibusdam debitis repellat culpa dicta est alias. Dicta ipsam maxime totam esse ratione. Ut ut ut in ullam sequi quo molestiae.", "user_id":2, "parent":0},
            {"id":16, "title":"Pariatur enim ut quia ea.", "body":"Molestiae soluta eum omnis et et est ad. Tenetur perspiciatis qui autem amet quisquam eum non eligendi. Excepturi sed quia aut.", "user_id":15, "parent":0},
            {"id":17, "title":"Ea et aut earum ab.", "body":"Autem fuga eaque voluptatibus. Eveniet minus voluptatem ab omnis omnis omnis. Sit praesentium ullam ullam voluptatem qui.", "user_id":40, "parent":0},
            {"id":18, "title":"Consectetur est et minima.", "body":"Hic iusto sit illum dolor. Est illo neque quae aut est mollitia. Doloremque voluptas consequatur maiores voluptatum magnam labore recusandae. Eum alias quidem magnam facilis voluptatem.", "user_id":30, "parent":0},
            {"id":19, "title":"Sed non hic odit dolore.", "body":"Magnam sunt eos qui in deserunt asperiores. Accusantium possimus voluptas quibusdam et occaecati. Iusto consequatur iure illo officiis.", "user_id":15, "parent":0},
            {"id":20, "title":"Ea placeat libero omnis ipsa.", "body":"Omnis ut in facere fugiat. Molestiae dolor beatae dicta tempore praesentium magni ut voluptatum. Laboriosam dolores sit hic.", "user_id":33, "parent":0},
            {"id":21, "title":"Ipsam a qui alias inventore.", "body":"Aliquid nostrum impedit porro laboriosam et quas ut. Dicta illo aspernatur quo sit qui ut ut. Fugiat corporis voluptatem eligendi ut vitae veritatis. Asperiores cum rerum aut ut neque inventore.", "user_id":4, "parent":0}];
    }

}

export default { name: 'TestMainController', controller: TestMainController };