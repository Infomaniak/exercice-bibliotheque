{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('firstname', 'Firstname:') !!}
			{!! Form::text('firstname') !!}
		</li>
		<li>
			{!! Form::label('lastname', 'Lastname:') !!}
			{!! Form::text('lastname') !!}
		</li>
		<li>
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email') !!}
		</li>
		<li>
			{!! Form::label('password', 'Password:') !!}
			{!! Form::text('password') !!}
		</li>
		<li>
			{!! Form::label('sex', 'Sex:') !!}
			{!! Form::text('sex') !!}
		</li>
		<li>
			{!! Form::label('role', 'Role:') !!}
			{!! Form::text('role') !!}
		</li>
		<li>
			{!! Form::label('verified', 'Verified:') !!}
			{!! Form::text('verified') !!}
		</li>
		<li>
			{!! Form::label('attachment', 'Attachment:') !!}
			{!! Form::text('attachment') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}