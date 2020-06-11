<?php
require_once 'init.php';

if(Input::exists()) {
    // check
    if(Token::check(Input::get('token'))) {

        $validation = new Validate();

        // check fields values to meet required parameters
        $validation->check($_POST, [
            'email' => [
                'required'=>true,
                'email'=>true],
            'password'  =>  ['required'=>true]
        ]);
        // Returns `Validate object`

        // check whether the `$passed property` of `Validate object` is TRUE or FALSE
        if($validation->passed()) {   // Returns TRUE or FALSE
            $user = new User; // without parameter

            // call `login method` on `User Object`
            $login = $user->login(Input::get('email'), Input::get('password')); // returns boolean

            if($login) {    // = if(isset($login)) {
                Redirect::to('index.php');
            } else {
                echo 'login failed';
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }
}

?>

<form action="" method="post">
    <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email" value="<?php echo Input::get('email')?>">
    </div>

    <div class="field">
        <label for="">Password</label>
        <input type="text" name="password" >
    </div>

    <input type="text" name="token" value="<?php echo Token::generate();?>">
    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>

