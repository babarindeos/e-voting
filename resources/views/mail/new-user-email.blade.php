<x-mail::message>
    @slot("header")
        <img src="{{ asset('images/logo.png')}}" alt="FUNAAB Logo" width="200" height="auto" />
    @endslot

# Welcome to FUNAAB e-Senate
Federal University of Agriculture Abeokuta

Dear {{ $fullname }},

A Staff account has been created for you to facilitate your official work activities from 
anywhere at anytime. 

Please find below your access credentials:

**Username:** {{ $username }}

**Password:** {{ $password }}

<x-mail::button :url="'https://www.e-senate.unaab.edu.ng/'">
 Go to e-Senate
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
