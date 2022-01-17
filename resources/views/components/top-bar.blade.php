<!-- As a heading -->
<nav class="navbar navbar-light bg-light d-flex justify-content-center align-items-center border">
    @if (Route::currentRouteName() == 'welcome')
      <span class="navbar-brand mb-0 h1">Company Name</span>
    @else
        <div class="steps-container">
          <div class="step-progress">
              <div class="percent"></div>
          </div>
          <div class="steps">
            <div class="step {{ Route::currentRouteName() == 'register.index' ? 'selected' : '' }}" id="0"></div>
            <div class="step {{ Route::currentRouteName() == 'register.show-positions' ? 'selected' : '' }}" id="1"></div>
            <div class="step {{ Route::currentRouteName() == 'applicant.qualification' ? 'selected' : '' }}" id="2"></div>
            <div class="step {{ Route::currentRouteName() == 'applicant.skillstest' ? 'selected' : '' }}" id="3"></div>
            <div class="step {{ Route::currentRouteName() == 'interview.Schedule' ? 'selected' : '' }}" id="4"></div>
            <div class="step" id="5"></div>
          </div>
        </div>
    @endif
</nav>

<script>
    let els = document.getElementsByClassName('step');
    let steps = [];
    Array.prototype.forEach.call(els, (e) => {
      steps.push(e);
    //   e.addEventListener('click', (x) => {
    //     progress(x.target.id);
    //     console.log(x.target.id);
      if(e.classList.contains('selected')){
          console.log();
          progress(e.id);
      }
    });

    function progress(stepNum) {
      let p = stepNum * 30;
      document.getElementsByClassName('percent')[0].style.width = `${p}%`;
      steps.forEach((e) => {
        if (e.id === stepNum) {
          e.classList.add('selected');
          e.classList.remove('completed');
        }
        if (e.id < stepNum) {
          e.classList.add('completed');
        }
        if (e.id > stepNum) {
          e.classList.remove('selected', 'completed');
        }
      });
    }
</script>