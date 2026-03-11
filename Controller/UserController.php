 <?php

    require_once "Models/User.php";
    require_once "Core/Auth.php";



    class UserController
    {
        public static function emailExist($email)
        {
            $data = User::find_by_email($email);
            $count = $data->rowCount();
            if ($count >= 1) {
                return true;
            }

            return false;
        }
        // storing new user
        public function store($data)
        {
            if (User::create($data)) {
                return true;
            } else {
                return false;
            }
        }

        public static function process_login($email, $password)
        {

            if (self::emailExist($email)) {
                $result = User::find_by_email($email);
                $user = $result->fetch();

                if (password_verify($password, $user->password)) {
                    Auth::login($user);
                    return true;
                }

                return false;
            }

            return false;
        }
    }
