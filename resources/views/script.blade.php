<script>
    const handleEvent = (event) => {
        const modalLabel = document.querySelector("#eventModalLabel")
        const eventForm = document.querySelector("#event-form")
        
        modalLabel.innerText = event ? "Editar Evento" : "Adicionar Evento"
        eventForm.action = event ? `/event/${event.id}` : "/event"
                
        if(event){
            const { title, description, date, id } = event;
            const mappedObj = { title, description, date };
            
            return Object.keys(mappedObj).forEach((item) => {
                document.querySelector(`#event-${item}`).value = mappedObj[item];
            });
        }

        return ["title", "description", "date"].forEach((item) => {
            document.querySelector(`#event-${item}`).value = "";
        });
    }

    const handleCopy = (eventId) => document.querySelector("#copy-form").action = `/event/copy/${eventId}`;
</script>