// // Initialize and add the map
// let map;

// async function initMap() {

//     // The location of Uluru
//     const position = { lat: -25.344, lng: 131.031 };

//     // Request needed libraries.
//     //@ts-ignore
//     const { Map } = await google.maps.importLibrary("maps");
//     const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

//     // The map, centered at Uluru
//     map = new Map(document.getElementById("company-location"), {
//         zoom: 15,
//         center: position,
//         mapId: "DEMO_MAP_ID",
//     });

//     // The marker, positioned at Uluru
//     const marker = new AdvancedMarkerElement({
//         map: map,
//         position: position,
//         title: "Uluru",
//     });
// }

// initMap();

// other custom js
(function () {

    window.addEventListener('load', function () {
        
        // server address
        const server = 'http://localhost:8000';
    
        // click on job card
        let jobCards = document.querySelectorAll('.custom-job-items');
        jobCards.forEach(jobCard => {
            jobCard.onclick = function () {
                let id = jobCard.dataset.id;
                location.assign(`${server}/jobs/${id}`);
            };
        });
        
        // click on candidate card
        let candidateCards = document.querySelectorAll('.custom-candidate-items');
        candidateCards.forEach(candidateCard => {
            candidateCard.onclick = function () {
                let id = candidateCard.dataset.id;
                location.assign(`${server}/users/${id}/profile`);
            };
        });
        
        // filter pagination
        let pageLinks = document.querySelectorAll('.page-link');
        pageLinks.forEach(pageLinks => {
            pageLinks.onclick = function (event) {
                
                event.preventDefault();
                
                let currentUrl = window.location.href;
                let linkHref = this.getAttribute('href');
                let pageQueryString;
    
                let index = currentUrl.lastIndexOf("page=");
                if (index > -1) {
                    currentUrl = currentUrl.substring(0, index - 1);
                }
    
                index = linkHref.lastIndexOf("page=");
                if (index > -1) {
                    pageQueryString = linkHref.substring(index);
                }
    
                if (currentUrl.lastIndexOf('?') > -1) {
                    location.assign(currentUrl + '&' + pageQueryString);
                } else {
                    location.assign(currentUrl + '?' + pageQueryString);
                }
            };
        });
    });
})();
