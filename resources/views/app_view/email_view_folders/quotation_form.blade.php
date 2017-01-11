<div id="id02" class="email_forms" style="display:block;">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id02').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" id = "mail" method ="post" action="{{url('/client_mail')}}">
         {{ csrf_field() }}
        <div class="w3-section">
            <input type="hidden" name="company_email" value="{{$userd->email}}">
            <input type="hidden" name="mail_type" value="quotation_request">
          
          <label class="w3-label w3-validate"><b>Email</b></label>
          <input class="form-control" type="email" placeholder="Enter Email" name="email" required>
          
          <label class="w3-label w3-validate"><b>Name</b></label>
          <input class="form-control" type="text" placeholder="Enter Name" name="name" required>
          
          <label class="w3-label">Type Event</label>
          <select name="event" class="form-control">
            @foreach($events as $event)
              <option value="{{$event->name}}">{{$event->name}}</option>
            @endforeach
          </select>
         
          <label class="w3-label">Location of the Event</label>
          <select name="estimated_attendees" class="form-control">
            <option>Lagos</option>
            <option>Abuja</option>
            <option>Kano</option>
          </select>
          
          <label class="w3-label">Estimated Attendees</label>
          <select name="estimated_attendees" class="form-control">
            <option>1-10</option>
            <option>11-50</option>
            <option>50-200</option>
            <option>250+</option>
          </select></br>
         
          <label class="w3-label">Event Date:</label>
          <input type="text" id="event_date" name="event_date" class="form-control" value = ""></br>
          
          <label class="w3-label" id="amount">Budget:</label>
          <input type="hidden" id="budget" name="budget" value = "" readonly>
          <div id="slider-range"></div></br>

          <label class="w3-label">Other Requests:</label>
          <textarea name="other_request" rows="3" cols="50" class="form-control"
          placeholder = "e.g steps of cakes,types of cakes, Bridal make-up">
          </textarea></br>
          
          <input class="w3-btn w3-blue w3-margin" value="Send Request" type="submit">
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button  onclick="document.getElementById('id02').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
      </div>

    </div>
  </div>