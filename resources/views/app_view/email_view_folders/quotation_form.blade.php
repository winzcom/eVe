<div id="id02" class="email_forms" style="display:block; ">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:400px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id02').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" id = "form_step"  method="post" action="{{url('/quotes_request')}}">
         {{ csrf_field() }}
          <fieldset>
           <legend>First Step</legend>
              <div>
                  <input type="hidden" name="company_category[]" value="{{$categories or ''}}">
                  <input type="hidden" name="company_name" value="{{$user->name_slug or ''}}">
                
                <label class="w3-label w3-validate"><b>*Email</b></label>
                <input class="form-control" type="email" placeholder="Enter Email" name="email" required>
                
                <label class="w3-label w3-validate"><b>*Name</b></label>
                <input class="form-control" type="text" placeholder="Enter Name" name="name" required>
                
                <label class="w3-label">Type Event</label>
                <select name="event" class="form-control">
                  @foreach($events as $event)
                    <option value="{{$event->name}}">{{$event->name}}</option>
                  @endforeach
                </select>
              </div>
            </fieldset>


         <fieldset>
            <legend>Second Step</legend>
            <div>
                <label class="w3-label">*Location of the Event</label>
                <select placeholder = "Select State" class="form-control cc " onchange = "changeVicinitySelect(this)"
                                          id="state" name="event_location"  required>
                                          @foreach($states as $state)
                                              <option value= "{{$state->state}}">{{$state->state}}</option>
                                          @endforeach
                </select>
                
                <label class="w3-label">Estimated Attendees</label>
                  <input type="number" id="estimated_attendees" name="estimated_attendees" class="form-control" value = "">
                </br>
              
                <label class="w3-label">*Event Date:</label>
                <input type="text" id="event_date" name="event_date" required class="form-control" value = ""></br>

                <label class="w3-label">Duration in Hours</label>
                <input type="number" id="event_date" name="duration" class="form-control" value = ""></br>
                
                <label class="w3-label" id="amount">Budget:</label>
                <input type="hidden" id="budget" name="budget" value = "" readonly>
                <div id="slider-range"></div></br>
                <div>
              </fieldset>
              <fieldset>
                <legend>Third</legend>
                <label class="w3-label">Other Requests:</label>
                <textarea name="other_request" rows="3" cols="50" class="form-control"
                placeholder = "e.g steps of cakes,types of cakes, Bridal make-up">
                </textarea></br>
              
              <input class="w3-btn w3-blue w3-margin" value="Send Request" type="submit">
              </fieldset>
          
            

      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button  onclick="document.getElementById('id02').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
      </div>

    </div>
  </div>