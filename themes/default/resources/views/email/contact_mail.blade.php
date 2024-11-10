<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A New Contact Email</title>
</head>
<body>
    
    @php
    
        $email_title = 'Email';
        if( $demo === true ){
            $email_title = 'Company Email';
        } 
        
    @endphp
    
    <p>Name: {{ $name }}</p>
    <p>{{ $email_title }}: {{ $email }}</p>
    <p>Phone: {{ $phone }}</p>
    <p>Company: {{ $company }}</p>
    <article>{{ $msg }}</article>
</body>
</html>