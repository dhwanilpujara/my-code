<!DOCTYPE html>
<html>
<head>
  <title>Multi-Step Form Example</title>
</head>
<body>
  <form id="multistep-form">
    <div class="step" data-step="1">
      <h3>Step 1</h3>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name">
      <button class="next" data-step="2">Next</button>
    </div>
    <div class="step" data-step="2">
      <h3>Step 2</h3>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email">
      <button class="prev" data-step="1">Back</button>
      <button class="next" data-step="3">Next</button>
    </div>
    <div class="step" data-step="3">
      <h3>Step 3</h3>
      <label for="message">Message:</label>
      <textarea id="message" name="message"></textarea>
      <button class="prev" data-step="2">Back</button>
      <button type="submit">Submit</button>
    </div>
  </form>

  <script>
    const form = document.getElementById('multistep-form');
    const steps = form.querySelectorAll('.step');
    const nextButtons = form.querySelectorAll('.next');
    const prevButtons = form.querySelectorAll('.prev');

    nextButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const currentStep = this.parentElement;
        const nextStep = form.querySelector(`[data-step="${this.getAttribute('data-step')}"]`);
        currentStep.style.display = 'none';
        nextStep.style.display = 'block';
      });
    });

    prevButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const currentStep = this.parentElement;
        const prevStep = form.querySelector(`[data-step="${this.getAttribute('data-step')}"]`);
        currentStep.style.display = 'none';
        prevStep.style.display = 'block';
      });
    });
  </script>
</body>
</html>
