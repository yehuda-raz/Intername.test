const getTerms = async () => {
  const response = await fetch('./assets/terms.json');
  if (response.status === 200) {
    return response.json()
  }
  else {
    throw new Error('Unable to fetch the Location')
  }
}



let terms;
getTerms().then(data => {
  terms = data;
}).catch((err) => {
  console.log(`Error: ${err}`)
})



const validator = (type, value) => {
  switch (type) {
    case 'notempty':
      if (value.length > 0) return true;
      return false

    case 'email':
      return !!(value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/))

  }
}


const generateErrorMsg = (element, type) => {
  const fieldName = $(element).attr('data-name');


  switch (type) {
    case 'notempty':
      return terms.text.replace("%s", fieldName)

    case 'email':
      return terms.email;
  }

}

jQuery(document).ready(($) => {

  const isValid = (element) => {
    const fieldType = $(element).attr('data-validator');
    const fieldText = element.value.trim();

    const feedback = $(element).closest('.form-group').find('.feedback');
    if (validator(fieldType, fieldText)) {
      $(element).removeClass('is-invalid').addClass('is-valid');
      feedback.removeClass('invalid-feedback').addClass('valid-feedback');
      feedback.text(terms.confirmed);
    }
    else {
      $(element).removeClass('is-valid').addClass('is-invalid');
      feedback.removeClass('valid-feedback').addClass('invalid-feedback');
      feedback.text(generateErrorMsg(element, fieldType));



    }

  }

  const el = ['#add_post input', '#add_post textarea'];
  el.forEach((e) => {
    $(e).keyup((el) => {
      isValid(el.target)
      // isFiledValid(e.target)
    })
  })


});

