@if(session('cookie'))
  <!-- Modal -->
  <div class="modal fade" id="cookieForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <a href="{{ route('welcome') }}" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </a>
        </div>
        <div class="modal-body">
          <div class="container d-flex flex-column align-items-start">
              <h1>Privacy Notice</h1>
              <p>At Company Name, we value your privacy and strive to protect your personal information in compliance with the Data Privacy Act of 2012.</p>
              <br>
              <p>Company Name will only collect, record, hold, use, disclose and store (i.e. “process”) use your information in accordance with such laws (including the Data Privacy Act of 2012), this Privacy Notice and the privacy terms in your agreement(s) with Company Name.</p>
              <br>
              <p>Data we collect from the aplicants are:</p>
              <br>
              <ul>
                <li>
                    Basic Information
                    <ul class="ml-3">
                        <li>Name</li>
                        <li>Sex</li>
                        <li>Date of birth</li>
                        <li>Contact Number</li>
                        <li>Email Address</li>
                    </ul>
                </li>
                <li>Resume</li>
              </ul>
              <br>
              <p>These data will be use to track your achievements and skills. It will help us to analyze you skills and qualification</p>
          </div>
        </div>
        <div class="modal-footer">
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Cancel</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Continue</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#cookieForm').modal();
    });
  </script>
@endif