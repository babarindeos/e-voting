<x-mail::message>
    @slot("header")
        <img src="{{ asset('images/logo.png')}}" alt="FUNAAB Logo" width="200" height="auto" />
    @endslot

# Voter Registration for FUNAABSU Elections
Federal University of Agriculture Abeokuta

Dear {{ $fullname }},

Congratulations for completing the Voter Registration process. 

Please find below your registration code for the elections:



**Registration code:** {{ $password }}



Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
