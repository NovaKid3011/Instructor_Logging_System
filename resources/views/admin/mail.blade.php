<p>Hello!</p>
<br>
<p>You receive a message: </p>
<br>
<input type="hidden" name="email" value="{{ session('email') }}">
<input type="hidden" name="content" value="{{ session('content') }}">
<p>Email: {{ session('email') ?? 'No description provided.' }}</p>
<p>Description: {{ session('content') ?? 'No description provided.' }}</p>
