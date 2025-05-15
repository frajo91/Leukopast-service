<x-mail::message>
## {{__('messages.mail_contrasena_titulo')}}

## {{__('messages.mail_contrasena_titulo_2')}}


{{__('messages.mail_contrasena_cuerpo_1',['correo'=>$correo])}}

<x-mail::panel color="danger">
# {{$contraseña}}
</x-mail::panel>

{{__('messages.mail_contrasena_cuerpo_2')}}


{{__('messages.mail_contrasena_cuerpo_3')}}

</x-mail::message>





