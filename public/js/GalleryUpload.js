"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[151],{7813:(e,t,s)=>{s.d(t,{Z:()=>n});var a=s(3645),o=s.n(a)()((function(e){return e[1]}));o.push([e.id,".custom-dropzone[data-v-66db24bc]{min-height:100px!important}.dropzone .dz-message[data-v-66db24bc]{margin:1em 0!important}",""]);const n=o},7030:(e,t,s)=>{s.r(t),s.d(t,{default:()=>p});var a=s(7244),o=s(1485),n=s.n(o);s(5721);const l={name:"galleryUpload",components:{vueDropzone:n()},props:{modalOptions:Object},data:function(){return{mediatGalleryUploadUrl,mediatGalleryListUrl,mediatGalleryDeleteUrl,defaultdictDefaultMessage:'<p class="text-danger">Please select category first.</p>',categoryModel2:"",config:{previewTemplate:this.template(),url:mediatGalleryUploadUrl,headers:{"My-Awesome-Header":"header value","X-CSRF-TOKEN":window.axios.defaults.headers.common["X-CSRF-TOKEN"]},params:{asset_type:"gallery",category:""},maxFilesize:20,maxFiles:25,thumbnailWidth:50,thumbnailHeight:50,acceptedFiles:".jpg, .jpeg, .png",autoProcessQueue:!1,parallelUploads:1,dictDefaultMessage:"",categoryModelOptionsLocal:[]},images:[],totalProgress:0,filesizeBase:1e3,dictFileSizeUnits:{tb:"TB",gb:"GB",mb:"MB",kb:"KB",b:"b"},galleryDatas:[],categoryOptions:[],showModal:!1,title:"",loadingSpinner:!1}},watch:{modalOptions:function(e){this.showModal=e.isOpen,this.title=e.title,this.categoryOptions=e.categoryOptions,this.categoryModel2="",this.config.dictDefaultMessage=this.defaultdictDefaultMessage},showModal:function(){}},mounted:function(){this.categoryModel2="",this.getItems()},created:function(){this.categoryModel2="",this.config.dictDefaultMessage=this.defaultdictDefaultMessage},methods:{getItems:function(){var e=this;this.loadingSpinner=!0,this.axios.get(mediatGalleryListUrl,{params:{asset_type:"gallery"}}).then((function(t){setTimeout((function(){e.loadingSpinner=!1}),1e3),e.galleryDatas=t.data.data})).catch((function(t){e.loadingSpinner=!1,console.log("error",t)}))},deleteItem:function(e){var t=this;console.log("deleteItem ",e.id),confirm("Are you sure want to delete?")&&(this.loadingSpinner=!0,this.axios({method:"delete",url:mediatGalleryDeleteUrl+"/"+e.id}).then((function(e){setTimeout((function(){t.loadingSpinner=!1,t.getItems()}),1e3)})).catch((function(e){t.loadingSpinner=!1,console.log("error",e)})))},show:function(){this.showModal=!0,setTimeout((function(){new a.Modal(document.getElementById("galleryUploadModal"),{keyboard:!1,backdrop:"static"}).show()}))},hide:function(){this.showModal=!1,this.$emit("close")},vdropzoneMounted:function(){this.$refs.galleryUploadDropZone.disable(),this.$refs.galleryUploadDropZone.removeAllFiles(!0),this.config.dictDefaultMessage=this.defaultdictDefaultMessage},onSelectChange:function(e){e&&e.preventDefault(),this.config.params.category=e.target.value,this.categoryModel2?(this.config.dictDefaultMessage="Drop files here to upload",this.$refs.galleryUploadDropZone.enable()):(this.config.dictDefaultMessage=this.defaultdictDefaultMessage,this.$refs.galleryUploadDropZone.disable())},openBrowse:function(){this.$refs.galleryUploadDropZone.$el.click()},enableUpload:function(){this.$refs.galleryUploadDropZone.enable()},startAllUpload:function(){this.$refs.galleryUploadDropZone.processQueue()},cancelAllUpload:function(){this.$refs.galleryUploadDropZone.removeAllFiles(!0),this.totalProgress=0},vdropzoneCanceled:function(){this.totalProgress=0},vdropzoneSuccess:function(e){var t=this,s=this,a=s.$refs.galleryUploadDropZone.getQueuedFiles().length;setTimeout((function(){a?e.previewElement.remove():(s.$refs.galleryUploadDropZone.removeAllFiles(!1),s.totalProgress=0),t.getItems()}),3e3)},prettySize:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",s=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"";if(e){var a=["Bytes","KB","MB","GB","TB"],o=Math.min(parseInt(Math.floor(Math.log(e)/Math.log(1024)).toString(),10),a.length-1);return"".concat((e/Math.pow(1024,o)).toFixed(o?1:0)).concat(t).concat(a[o]).concat(s)}return""},prettySize2:function(e){var t=0,s="b";if(e>0){for(var a=["tb","gb","mb","kb","b"],o=0;o<a.length;o++){var n=a[o];if(e>=Math.pow(this.filesizeBase,4-o)/10){t=e/Math.pow(this.filesizeBase,4-o),s=n;break}}t=Math.round(10*t)/10}return"".concat(t," - ").concat(this.dictFileSizeUnits[s])},vdropzoneUploadProgress:function(e,t,s){if(e.previewElement){var a=e.previewElement.querySelector("[data-dz-uploadprogress]");a.style.width=t+"%",a.querySelector(".progress-text").textContent=parseInt(t)+"% ",e.previewElement.querySelector(".progress-info .progress-size").textContent=this.prettySize(s)+" / "+this.prettySize(e.size),100==t&&(a.classList.remove("progress-bar-animated","bg-secondary"),a.classList.add("bg-success"))}},vdropzoneTotalUploadProgress:function(e){this.totalProgress=e},vdropzoneProcessing:function(){},vdropzoneFileAdded:function(){},template:function(){return'\n            <div id="previews-gallery" class="file-row">\n                <table class="table table-sm">\n                    <thead>\n                    <tr>\n                        <th width="10%">Preview</th>\n                        <th width="50%">Name</th>\n                        <th width="10%">Size</th>\n                        <th width="20%">Progress</th>\n                        <th width="10%" style="text-align: right;">Action</th>\n                    </tr>\n                    </thead>\n                    <tbody>\n                    <tr>\n                        <td>\n                            <span class="preview"><img data-dz-thumbnail/></span>\n                        </td>\n                        <td>\n                            <p class="mb-0 name" data-dz-name></p>\n                            <p class="error text-danger" data-dz-errormessage></p>\n                        </td>\n                        <td>\n                            <p class="size" data-dz-size></p>\n                        </td>\n                        <td>\n                            <div class="progress-info">\n                              <div class="progress">\n                                  <div \n                                  class="progress-bar progress-bar-striped bg-secondary progress-bar-animated" \n                                  role="progressbar" \n                                  aria-valuenow="0"\n                                  aria-valuemin="0"\n                                  aria-valuemax="100"\n                                  style="width:0%;"\n                                  data-dz-uploadprogress\n                                  >\n                                    <span class="progress-text"></span>\n                                  </div>                                  \n                              </div>\n                              <div class="progress-size text-secondary text-center" style="font-size: 10px;"></div>\n                            </div>\n                        </td>\n                        <td align="right">                          \n                            <button\n                                data-dz-remove\n                                class="btn btn-sm btn-warning text-white cancel"\n                            >\n                                <font-awesome-icon :icon="[\'fas\', \'ban\']" />\n                                cancel\n                            </button>\n                            <button data-dz-remove class="btn btn-sm btn-danger delete">\n                                <font-awesome-icon :icon="[\'fas\', \'trash\']" />\n                                delete\n                            </button>\n                        </td>\n                    </tr>\n                    </tbody>\n                </table>\n                 <style>\n                    /* Hide the progress bar when finished */\n                    #previews .file-row.dz-success .progress {\n                      opacity: 0;\n                      transition: opacity 0.3s linear;\n                    }\n                    /* Hide the delete button initially */\n                    /*dz-image-preview dz-processing dz-success dz-complete*/                  \n                    /*\n                    #dropzone .file-row.dz-success .progress {\n                      opacity: 0 !important;\n                      transition: opacity 0.3s linear !important;\n                      display: none;\n                    }\n                    \n                    #dropzone .file-row .progress-done {\n                      display: none;\n                    }\n                    #dropzone .file-row.dz-success .progress-done {\n                      display: block;\n                      opacity: 1 !important;\n                      transition: opacity 0.3s linear !important;\n                    }*/\n                    #dropzone .file-row .delete {\n                      display: none;\n                    }\n                    /* Hide the start and cancel buttons and show the delete button */\n                    #dropzone .file-row.dz-success .start,\n                    #dropzone .file-row.dz-success .cancel {\n                      display: none;\n                    }\n                    #dropzone .file-row.dz-success .delete {\n                      display: block;\n                      opacity: 0.5;\n                      transition: opacity 0.3s linear;\n                    }\n                  </style>\n            </div>           \n            '}}};var i=s(3379),r=s.n(i),d=s(7813),c={insert:"head",singleton:!1};r()(d.Z,c);d.Z.locals;const p=(0,s(1900).Z)(l,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"galleryupload"},[e.showModal?s("div",{staticClass:"modal fade",attrs:{id:"galleryUploadModal",tabindex:"-1","aria-labelledby":"exampleModalLabel","aria-hidden":"true"}},[s("div",{staticClass:"modal-dialog modal-xl modal-dialog-scrollable"},[s("div",{staticClass:"modal-content"},[s("div",{staticClass:"modal-header"},[s("h5",{staticClass:"modal-title",attrs:{id:"galleryUploadModalLabel"}},[e._v("\n            Upload "+e._s(e.title)+" Images\n          ")]),e._v(" "),s("button",{staticClass:"btn-close",attrs:{type:"button","data-bs-dismiss":"modal","aria-label":"Close"},on:{click:e.hide}})]),e._v(" "),s("div",{staticClass:"modal-body"},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-md-8"},[s("div",{staticClass:"row g-3 align-items-center"},[s("div",{staticClass:"col-auto"},[s("select",{directives:[{name:"model",rawName:"v-model",value:e.categoryModel2,expression:"categoryModel2"}],staticClass:"form-select form-select-sm",attrs:{name:"category"},on:{change:[function(t){var s=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.categoryModel2=t.target.multiple?s:s[0]},function(t){return e.onSelectChange(t)}]}},[s("option",{attrs:{value:""}},[e._v("Select")]),e._v(" "),e._l(e.categoryOptions,(function(t){return s("option",{key:t.value,domProps:{value:t.value}},[e._v("\n                      "+e._s(t.text)+"\n                    ")])}))],2)]),e._v(" "),s("div",{staticClass:"col-auto"},[s("button",{staticClass:"btn btn-sm btn-secondary mr-2",attrs:{id:"fileinput-button",disabled:!e.categoryModel2},on:{click:e.openBrowse}},[s("font-awesome-icon",{attrs:{icon:["fas","plus-square"]}}),e._v(" "),s("span",[e._v(" Add files...")])],1),e._v(" "),s("button",{staticClass:"btn btn-sm btn-success mr-2",attrs:{disabled:!e.categoryModel2},on:{click:function(t){return e.startAllUpload(t)}}},[s("font-awesome-icon",{attrs:{icon:["fas","upload"]}}),e._v(" "),s("span",[e._v(" Start upload")])],1),e._v(" "),s("button",{staticClass:"btn btn-sm btn-warning",attrs:{disabled:!e.totalProgress},on:{click:e.cancelAllUpload}},[s("font-awesome-icon",{attrs:{icon:["fas","trash"]}}),e._v(" "),s("span",[e._v(" Cancel upload")])],1)])])]),e._v(" "),s("div",{staticClass:"col-md-4"},[s("div",{staticClass:"progress-total"},[s("div",{staticClass:"progress"},[s("div",{staticClass:"progress-bar bg-secondary progress-bar-striped",class:{"progress-bar-animated":e.totalProgress>0&&e.totalProgress<99.99,"bg-success":e.totalProgress>99.99},style:{width:e.totalProgress+"%"},attrs:{role:"progressbar","aria-valuenow":e.totalProgress,"aria-valuemin":"0","aria-valuemax":"100"}},[s("span",{staticClass:"progress-text"},[e._v(e._s(parseInt(e.totalProgress))+"%")])])]),e._v(" "),s("div",{staticClass:"progress-size text-secondary text-center",staticStyle:{"font-size":"10px"}})])])]),e._v(" "),s("div",{staticClass:"row my-2"},[s("div",{staticClass:"col"},[s("vue-dropzone",{ref:"galleryUploadDropZone",staticClass:"custom-dropzone",attrs:{height:"100",id:"dropzone",options:e.config,useCustomSlot:!0,"include-styling":!0},on:{"vdropzone-total-upload-progress":e.vdropzoneTotalUploadProgress,"vdropzone-processing":e.vdropzoneProcessing,"vdropzone-file-added":e.vdropzoneFileAdded,"vdropzone-upload-progress":e.vdropzoneUploadProgress,"vdropzone-canceled":e.vdropzoneCanceled,"vdropzone-success":e.vdropzoneSuccess,"vdropzone-mounted":e.vdropzoneMounted}},[s("div",{staticClass:"dropzone-custom-content"},[s("div",{staticClass:"dz-default dz-message"},[s("span",{domProps:{innerHTML:e._s(e.config.dictDefaultMessage)}})])])])],1)]),e._v(" "),s("div",{staticClass:"row pt-1"},[s("div",{staticClass:"col-md-6 "},[e._v("\n\n             Uploaded Files\n            ")]),e._v(" "),s("div",{staticClass:"col-md-6 text-end"},[s("button",{staticClass:"btn btn-sm btn-secondary",attrs:{disabled:e.loadingSpinner},on:{click:e.getItems}},[s("font-awesome-icon",{attrs:{icon:["fas","sync"],spin:e.loadingSpinner}})],1)])]),e._v(" "),s("div",{staticClass:"table-responsive  pt-1"},[s("table",{staticClass:"table table-sm table-bordered"},[e._m(0),e._v(" "),s("tbody",[e.loadingSpinner?s("tr",[s("td",{attrs:{colspan:"8",align:"center"}},[s("font-awesome-icon",{attrs:{icon:"spinner",spin:e.loadingSpinner}})],1)]):e._e(),e._v(" "),e.loadingSpinner||0!=e.galleryDatas.length?e._e():s("tr",[s("td",{attrs:{colspan:"8",align:"center"}},[e._v("\n                    No Data found.\n                  ")])]),e._v(" "),e._l(e.galleryDatas,(function(t,a){return e.loadingSpinner?e._e():s("tr",{key:t.id},[s("td",[e._v(e._s(a+1))]),e._v(" "),s("td",[e._v(e._s(t.id))]),e._v(" "),s("td",[s("img",{staticClass:"img-fluid",attrs:{src:e.$getPublicPath(t.media_s3_base_path+t.local_path),width:"90",height:"50"}})]),e._v(" "),s("td",[e._v(e._s(t.file_name))]),e._v(" "),s("td",[e._v(e._s(t.category))]),e._v(" "),s("td",[e._v(e._s(t.created_at.split("T")[0]))]),e._v(" "),s("td",[s("button",{staticClass:"btn btn-sm btn-danger",attrs:{type:"button"},on:{click:function(s){return e.deleteItem(t)}}},[s("font-awesome-icon",{attrs:{icon:["fas","trash"]}})],1)])])}))],2)])])])])])]):e._e()])}),[function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("thead",[s("tr",[s("th",[e._v("S.NO.")]),e._v(" "),s("th",[e._v("ID")]),e._v(" "),s("th",[e._v("Image")]),e._v(" "),s("th",[e._v("Name")]),e._v(" "),s("th",[e._v("Category")]),e._v(" "),s("th",[e._v("Created At")]),e._v(" "),s("th",[e._v("Action")])])])}],!1,null,"66db24bc",null).exports}}]);