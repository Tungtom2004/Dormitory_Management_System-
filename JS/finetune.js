$(document).ready(function() {
    const apiUrl = 'https://api.cohere.ai/v1/chat';

    $.getJSON('path/to/training_data.json', function(trainingData) {
        if (!trainingData) {
            console.error("Dữ liệu huấn luyện không được tải.");
            return;
        }

        $.ajax({
            url: apiUrl,
            method: 'POST',
            headers: {
                'Authorization': 'fsQGJ5CKCCmjs0Y55JCpMBEBxHulvj3VhSjEqaCj',
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                "training_data": trainingData,
                "model": "command-r-plus"
            }),
            success: function(response) {
                console.log('Finetuning successful:', response);
            },
            error: function(error) {
                console.error('Error during finetuning:', error);
            }
        });
    }).fail(function() {
        console.error("Không thể tải file JSON.");
    });
});