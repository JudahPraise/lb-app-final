@component('mail::message')
# Good Day {{ $name }}!

# We want to know you more 🎉

HR decides to give you a second interview for the position of {{ $job }},
that will be held on {{ $date }} at {{ $time }}

This is the meeting link for your interview: <br>
<a href="{{ $link }}">{{ $link }}</a>


Good luck! 🎇

Thanks<br>

@endcomponent
