<x-layout title="Create">
    <h1>Post a showcase</h1>

    <form action="{{ route('showcase.index') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Describe this showcase.."></textarea>
        </div>

        {{--        <div>--}}
        {{--            <label for="image">Choose a file..</label>--}}
        {{--            <input type="file" id="image" name="image">--}}
        {{--        </div>--}}

        <div>
            <button type="submit">Post</button>
        </div>
    </form>
</x-layout>
