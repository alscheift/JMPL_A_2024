@props(['comment'])
<x-panel class="bg-gray-50">
    <article class="flex space-x-4">
        @isset($comment?->author)
            <div class="flex-shrink-0">
                <img src="https://ui-avatars.com/api/?name={{auth()->user()->name??'Unknown'}}&background=0D8ABC&color=fff" alt="" width="60" height="60"
                     class="rounded-xl">
            </div>

            <div>
                <header>
                    <h3 class="font-bold">{{$comment->author->username}}</h3>
                    <p class="text-xs">
                        Posted
                        <time>{{$comment->created_at->diffForHumans()}}</time>
                    </p>
                </header>
                <p>
                    {{$comment->body}}
                </p>

            </div>
        @else
            <div>
                <header>
                    <h3 class="font-bold text-red-500">User does not exist</h3>
                    <p class="text-xs">
                        Posted
                        <time>{{$comment->created_at->diffForHumans()}}</time>
                    </p>
                </header>
                <p>
                    {{$comment->body}}
                </p>
            </div>
        @endisset
    </article>
</x-panel>
