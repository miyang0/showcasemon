<x-layout>
    <h1>Post a showcase</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <label for="title">Title</label>
        <input type="text" id="title" name="title">

        <label for="description">Description</label>
        <textarea name="description" id="description" placeholder="Describe this showcase.."></textarea>

        <label for="image">Choose a file..</label>
        <input type="file" id="image" name="image">


        <button type="submit">Post</button>
    </form>
</x-layout>
