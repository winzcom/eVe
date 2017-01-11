<div id="id01" class="email_forms" style="display:block;">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" id = "mail" 
      method ="post" 
      action="{{url('/client_mail')}}"
      v-on:submit.prevent="submitEmail">
         {{ csrf_field() }}
        <div class="w3-section">
            <input type="hidden" name="company_email" value="{{$userd->email}}">
            
          <label class="w3-label w3-validate"><b>Email</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Email" name="email" required>

          <label class="w3-label w3-validate">Content</label>
          <textarea name="content" rows="10" cols="60" class="form-control" required></textarea>

          <input class="w3-btn-block w3-blue" value="Send Mail" type="submit">
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button  onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
      </div>

    </div>
  </div>