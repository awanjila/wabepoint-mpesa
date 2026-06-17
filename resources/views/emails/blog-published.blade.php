<x-mail::message>
# New Blog Post: {{ $blog->name }}

Hi {{ $name }},

We've published a new article on the WabePoint blog:

**{{ $blog->name }}**

{{ strip_tags($blog->content) }}

<x-mail::button :url="route('blogs.show', $blog->slug)">
Read Full Article
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
