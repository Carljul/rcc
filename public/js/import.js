let dropArea = document.getElementById('drop-area');

;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false)
})

function preventDefaults (e) {
    e.preventDefault()
    e.stopPropagation()
}

;['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false)
})

;['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false)
})

function highlight(e) {
    dropArea.classList.add('highlight')
}

function unhighlight(e) {
    dropArea.classList.remove('highlight')
} 

dropArea.addEventListener('drop', handleDrop, false)

function handleDrop(e) {
    let dt = e.dataTransfer
    let files = dt.files

    handleFiles(files)
}

function handleFiles(files) {
    let list = [...files];
    createFileList(list)
    list.forEach(uploadFile)
}

function uploadFile(file) {
    // let url = 'YOUR URL HERE'
    // let formData = new FormData()
    
    // formData.append('file', file)
    
    // fetch(url, {
    //   method: 'POST',
    //   body: formData
    // })
    // .then(() => { /* Done. Inform the user */ })
    // .catch(() => { /* Error. Inform the user */ })
}

function createFileList(files)
{
    let html = '';
    for (let i = 0; i < files.length; i++) {
        const element = files[i];
        html += `<tr id="`+i+`">
            <td>`+element.name+`</td>
            <td>
                <!-- <div class="progress">
                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>-->
                Processing. . .
            </td>
        </tr>`;
    }

    $('#fileList tbody').html(html);

    $('#drop-area').addClass('hide');
    $('#progress-area').removeClass('hide');
}