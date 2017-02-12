Click here to Reset your Password: <br>
<a href=""{{$link = url('password/reset',$otken).'?email='.urlencode($user->getEmailForPasswordReset())}}>{{ $link }}</a>