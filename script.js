document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from PHP endpoint
    fetch('api.php')
        .then(response => response.json())
        .then(data => {
            const studentsContainer = document.getElementById('students-container');

            // Create a card for each student
            data.forEach(student => {
                const studentCard = document.createElement('div');
                studentCard.className = 'student';
                studentCard.innerHTML = `<strong>ID:</strong> ${student.id}<br><strong>Nome:</strong> ${student.nome}<br><strong>Curso:</strong> ${student.curso}`;
                studentsContainer.appendChild(studentCard);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
