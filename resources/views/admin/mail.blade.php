<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>

<body>



<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">

<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">


<tr>
<td class="content-cell">
<p>Hello!</p>
<br>
<p>You receive a message: </p>
<br>

<input type="hidden" name="email" value="{{ session('email') }}">
<input type="hidden" name="content" value="{{ session('content') }}">
<p>Email: {{ session('email') ?? 'No description provided.' }}</p>
<p>Description: {{ session('content') ?? 'No description provided.' }}</p>

</td>
</tr>
</table>
</td>
</tr>

</table>
</td>
</tr>
</table>


</body>
</html>



