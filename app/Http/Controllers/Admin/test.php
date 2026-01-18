 <div class="row g-4">

     <div class="col-12 mt-4">
         <label class="form-label fw-bold">
             कृषक के हस्ताक्षर सहित शपथ पत्र अपलोड करें *
         </label>
         <button type="button" class="btn btn-success" id="downloadSignatureBtn">
             डाउनलोड शपथ पत्र
         </button>

         <div class="row align-items-center mt-2">
             <div class="col-md-6">
                 <input type="file"
                     name="kisanSign"
                     id="kisanSign"
                     accept="image/*"
                     class="form-control mb-2"
                     capture="environment"
                     required>
                 <small class="text-muted">
                     ✓ शपथ पत्र स्पष्ट रूप से दिखना चाहिए
                 </small>
             </div>

             <div class="col-md-6">
                 <div class="preview-box border p-2 text-center" style="min-height:150px;">

                     <div id="previewContainer">
                         <img id="kisanSignPreview"
                             src="includes/no-photos.png"
                             style="max-width:100%; max-height:150px; object-fit:contain;">
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <script>
         document.getElementById('kisanSign').addEventListener('change', function(e) {
             const file = e.target.files[0];
             if (!file) return;

             const previewContainer = document.getElementById('previewContainer');
             previewContainer.innerHTML = '';

             const fileType = file.type;

             if (fileType.startsWith('image/')) {
                 const img = document.createElement('img');
                 img.style.maxWidth = '100%';
                 img.style.maxHeight = '150px';
                 img.style.objectFit = 'contain';
                 const reader = new FileReader();
                 reader.onload = () => img.src = reader.result;
                 reader.readAsDataURL(file);
                 previewContainer.appendChild(img);
             } else if (fileType === 'application/pdf') {
                 const pdfEmbed = document.createElement('embed');
                 pdfEmbed.src = URL.createObjectURL(file);
                 pdfEmbed.type = 'application/pdf';
                 pdfEmbed.width = '100%';
                 pdfEmbed.height = '150px';
                 previewContainer.appendChild(pdfEmbed);
             } else if (fileType === 'text/html') {
                 const iframe = document.createElement('iframe');
                 iframe.style.width = '100%';
                 iframe.style.height = '150px';
                 iframe.src = URL.createObjectURL(file);
                 previewContainer.appendChild(iframe);
             } else {
                 previewContainer.innerHTML = 'Preview not available';
             }
         });
     </script>


     <div class="col-12">
         <label class="form-label fw-bold">स्थल एवं कृषक की फोटो (जल स्रोत सहित) *</label>
         <div class="row align-items-center">
             <div class="col-md-6">
                 <input type="file" name="kisanPhoto" id="kisanPhoto" accept="image/*" capture="environment" class="form-control mb-2" required>
                 <small class="text-muted">✓ कृषक और जल स्रोत स्पष्ट दिखे</small>
             </div>
             <div class="col-md-6">
                 <div class="preview-box"><img id="kisanPreview" src="includes/no-photos.png"></div>
             </div>
         </div>
         <input type="hidden" name="contact_no" value="<?= $_SESSION['contact_no'] ?>">
         <input type="hidden" name="lat" id="lat">
         <input type="hidden" name="lng" id="lng">
     </div>

     <div class="col-md-6">
         <label class="form-label">आधार कार्ड (Front) *</label>
         <input type="file" name="aadhaarFront" id="aadhaarFront" accept="image/*" capture="environment" class="form-control" required>
         <div class="preview-box mt-2"><img id="frontPreview" src="includes/no-photos.png"></div>
     </div>

     <div class="col-md-6">
         <label class="form-label">आधार कार्ड (Back) *</label>
         <input type="file" name="aadhaarBack" id="aadhaarBack" accept="image/*" capture="environment" class="form-control" required>
         <div class="preview-box mt-2"><img id="backPreview" src="includes/no-photos.png"></div>
     </div>
 </div>