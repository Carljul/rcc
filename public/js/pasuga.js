$(document).ready(() => {
    // input fields
    let name = $('#lightingModal #name')
    let expiryDate = $('#lightingModal #expiryDate')
    let dateOfConnection = $('#lightingModal #dateOfConnection')
    let amount = $('#lightingModal #amount')
    let ornumber = $('#lightingModal #ornumber')
    let deceasedPerson = $('#lightingModal #deceasedPerson')

    // form
    let lightingForm = $('#lightingForm')

    $('#tableLightings').on('click', '.btn-edit-lighting', (e) => {
        const id = e.target.dataset.id;
        fetch(lightingOne.replace('pasugaId', id)).then(e => e.json())
            .then(data => {
                data = data.data

                name.val(data.name)
                amount.val(data.amount)
                ornumber.val(data.ORNumber)
                expiryDate.val(data.expiryDate)
                deceasedPerson.val(data.deceased_id)
                dateOfConnection.val(data.dateOfConnection)

                // change form action
                lightingForm.attr('action', `${lightingUpdate}/${id}`);
            })
    })
})
