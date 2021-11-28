<script>
    function copyContent () {
    document.getElementById("new-description").value =  
        document.getElementById("description-pan").innerHTML;
    return true;
}
</script>

<form action="/update-description" method="post" onsubmit="return copyContent()">
    @csrf
    <input type="hidden" id="new-description" name="description">
    <button class="btn btn-primary">Update Description</button>
</form>