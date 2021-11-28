        <!-- Modal -->
        <div class="modal fade" id="reserve" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Reserve a spot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/submit-booking" method="post">
          @csrf
  <div class="form-group">
  <div class="form-group">
    <label for="">Pick a time</label>
    <select class="form-control" name="option" required>
    <option value="" disabled selected id="emptyItem"></option>
    @foreach($calData['availableSlots'] as $day => $timeList)
     @foreach($timeList as $time)
      <option value="{{$time}}"  class="options-list day-{{$day}}">{{$time}}</option>
     @endforeach
    @endforeach
    </select>
    <input type="hidden" value="{{$currentDate}}" name="date" >
    <input type="hidden" id="selectedDay" name="day" >
  </div>
  <div class="form-group">
  <label for="">Name</label>
  <input type="name" class="form-control" name="name" required placeholder="name">
</div>
<div class="form-group">
  <label for="">Phone number</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">+</span>
        </div>
        <input type="text" class="form-control" required id="validationCustomUsername" placeholder="phone number" name="number" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback">
        </div>
      </div>
    </div>
    <div class="form-group">
    <label for="">Email address<sub>for reminder<sub></label>
    <input type="email" class="form-control" id="" name="email" placeholder="name@example.com">
    </div>
    <div class="form-group">
    <label for="">Note</label>
    <textarea class="form-control" name="note" id="" rows="3"></textarea>
  </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Reserve</button>
</div>
</form>
    </div>
  </div>
</div>

<script>
function openModal(id)
{
    // show chosen day options only
    showOptions('day-'+id);
    //open modal
    $('#reserve').modal();
    selectedDay.value = id; 
}

function hideAllOptions() {
    var allOptions = $('.options-list');
    var length = allOptions.length;
    for(var i = 0; i < length; i++) {
        allOptions[i].style.display = 'none';
    }

    // select empty default
    emptyItem.selected = true;
}

function showOptions(className) {
    hideAllOptions();
    var selectedOptions = $('.'+className);
    var length = selectedOptions.length;
    for(var i = 0; i < length; i++) {
        console.log(selectedOptions[i], i);
        selectedOptions[i].style.display = 'block';
    }
    // select empty default
    emptyItem.selected = true;
}
</script>