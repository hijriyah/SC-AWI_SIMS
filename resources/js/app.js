import './bootstrap';
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import { ClassicEditor, Essentials, Paragraph, Heading, List, Bold, Italic, FontColor } from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';


FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateSize);

// Ckeditor 5
ClassicEditor
   .create( document.querySelector( '#editor' ), {
      plugins: [
         Essentials, Paragraph, Heading, List, Bold, Italic, FontColor
     ],
     toolbar: [ 'heading', 'bold', 'italic', 'numberedList', 'bulletedList', 'fontcolor' ]
   } )
   .then( editor => {
      console.log( 'Editor was initialized', editor );
   } )
   .catch( error => {
      // console.error( error.stack );
   } 
);


// // Full Calendar
// import { Calendar } from 'fullcalendar';
// // import dayGridPlugin from '@fullcalendar/daygrid';

// document.addEventListener('DOMContentLoaded', function() {
//   const calendarEl = document.getElementById('calendar')
//   const calendar = new Calendar(calendarEl, {
//       initialView: 'dayGridMonth',
//       contentHeight: 'auto',
//       eventClick: function(info) {
//          // alert('hacked');
//       },
//       eventMouseEnter: function() {

//       }
//   })
//   calendar.render();
// })