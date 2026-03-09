 <?php

    require_once "Models/User.php";


    class UserController
    {
        // storing new user
        public function store($data)
        {
            if (User::create($data)) {
                return true;
            } else {
                return false;
            }
        }
    }
