@props(['post'])
<div class="flex items-center text-sm">
    @isset($post->author)
        <img src="https://ui-avatars.com/api/?name={{$post->author->name??'Unknown'}}&background=0D8ABC&color=fff" class="rounded-xl" alt="User Avatar">
    @endisset
    <div class="ml-3">
        <h5 class="font-bold">
            @isset($post->author)
                <a href="/authors/{{$post->author->username}}">{{$post->author->name}}</a>
            @else
                <p class="font-bold text-red-500">User does not exist</p>
            @endisset
        </h5>
        <h6 class="text-gray-600">{{$post->author->username??'-'}}</h6>
    </div>
</div>
