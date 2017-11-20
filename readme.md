## Lumen Custom Passport Configuration
> Laravel Lumen Configuration When your password is stored in a different table and with different name

`User.php`
```

    public function validateForPassportPasswordGrant($password)
    {
        $data = \Illuminate\Support\Facades\Request::all();
        $user = $this->where('email', $data['username'])->first();
        if (count($user) < 1)
            return false;

        $userId = $user->uid;
        $security = Login::where(['uid' => $userId])->first();
        if (count($security) < 1)
            return false;

        $userPassword = $security->password;

        return (Hash::check($password, $userPassword));
    }
```