$range = $('.js-range-slider')
$courseRange = $('.course-range-slider')
if ($range.length) {
  $inputFrom = $('.js-input-from')
  $inputTo = $('.js-input-to')
  const min = 10_000
  const max = 300_000
  const step = 1000 
  const fromVal = document.querySelector('.js-input-from').value || 10_000
  const toVal = document.querySelector('.js-input-to').value || 300_000
  
  
  $range.ionRangeSlider({
    skin: 'round',
    type: 'double',
    min: min,
    max: max,
    step: step,
    from: fromVal,
    to: toVal,
    onStart: updateInputs,
    onChange: updateInputs
  })
  instance = $range.data('ionRangeSlider')
  
  function updateInputs (data) {
  	from = data.from;
      to = data.to;
      
      $inputFrom.prop("value", from);
      $inputTo.prop("value", to);	
  }
  
  $inputFrom.on("input", function () {
      var val = $(this).prop("value");
      
      // validate
      if (val < min) {
          val = min;
      } else if (val > to) {
          val = to;
      }
      
      instance.update({
          from: val
      });
  });
  
  $inputTo.on("input", function () {
      var val = $(this).prop("value");
      
      // validate
      if (val < from) {
          val = from;
      } else if (val > max) {
          val = max;
      }
      
      instance.update({
          to: val
      });
  });
  
  $slider = $('.range-slider')
  $rangeItem = $('.range__item')
  $dMatter = $('#filter-salary-doesnt-matter')
  $own = $('#filter-salary-own')
  
  $slider.hide()
  $rangeItem.hide()
  
  $own.on('click', () => {
    $slider.show()
    $rangeItem.show()
  })
  $dMatter.on('click', () => {
    $slider.hide()
    $rangeItem.hide()
  })
}

if ($courseRange.length) {
  $inputFrom = $('.course-input-from')
  $inputTo = $('.course-input-to')
  const min = 1
  const max = 100
  const step = 1 
  const fromVal = document.querySelector('.course-input-from').value || 1
  const toVal = document.querySelector('.course-input-to').value || 100
  
  
  $courseRange.ionRangeSlider({
    skin: 'round',
    type: 'double',
    min: min,
    max: max,
    step: step,
    from: fromVal,
    to: toVal,
    onStart: updateInputs,
    onChange: updateInputs
  })
  instance = $courseRange.data('ionRangeSlider')
  
  function updateInputs (data) {
  	from = data.from;
      to = data.to;
      
      $inputFrom.prop("value", from);
      $inputTo.prop("value", to);	
  }
  
    $inputFrom.on("input", function () {
      var val = $(this).prop("value");
      
      // validate
      if (val < min) {
          val = min;
      } else if (val > to) {
          val = to;
      }
      
      instance.update({
          from: val
      });
  });
  
  $inputTo.on("input", function () {
      var val = $(this).prop("value");
      
      // validate
      if (val < from) {
          val = from;
      } else if (val > max) {
          val = max;
      }
      
      instance.update({
          to: val
      });
  });
  
  $ageCourse = $('#age-range')
  $ageItem = $('#age-range-item')
  $ageDMatter = $('#filter-age-any')
  $ageOwn = $('#filter-age-own')
  $durationCourse = $('#duration-range')
  $durationItem = $('#duration-range-item')
  $durationDMatter = $('#filter-duration-any')
  $durationOwn = $('#filter-duration-own')
  
  $ageCourse.hide()
  $ageItem.hide()
  $durationCourse.hide()
  $durationItem.hide()
  
  $durationOwn.on('click', () => {
    $durationCourse.show()
    $durationItem.show()
  })
  $durationDMatter.on('click', () => {
    $durationCourse.hide()
    $durationItem.hide()
  })
  $ageOwn.on('click', () => {
    $ageCourse.show()
    $ageItem.show()
  })
  $ageDMatter.on('click', () => {
    $ageCourse.hide()
    $ageItem.hide()
  })
}



















