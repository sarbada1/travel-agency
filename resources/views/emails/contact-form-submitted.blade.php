{{-- filepath: /home/sarbada/Desktop/booking/resources/views/emails/contact-form-submitted.blade.php --}}

@component('mail::message')
# New Contact Form Submission

You have received a new message from your website's contact form.

**Contact Details:**
- **Name:** {{ $contact->name }}
- **Email:** {{ $contact->email }}
@if($contact->phone)
- **Phone:** {{ $contact->phone }}
@endif
- **Inquiry Type:** {{ ucfirst($contact->inquiry_type) }}

**Message:**
{{ $contact->message }}

@component('mail::button', ['url' => route('admin.contacts.index')])
View All Contact Messages
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent