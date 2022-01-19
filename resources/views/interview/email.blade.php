@component('mail::message')
# Good Day {{ $name }}!

# Congratulations 🎉

You passed the qualification and skills test for the position of {{ $job }},
you are qualified for the interview on {{ $date }} at {{ $time }}

This is the meeting link for your interview: <br>
<a href="{{ $link }}">{{ $link }}</a>


Good luck! 🎇

Thanks<br>

@endcomponent
