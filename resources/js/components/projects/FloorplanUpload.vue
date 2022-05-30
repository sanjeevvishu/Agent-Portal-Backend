<template>
  <div class="galleryupload">
    <div
      class="modal fade"
      id="galleryUploadModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel" 
      aria-hidden="true"
      v-if="showModal"
    >
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="galleryUploadModalLabel">
              Upload {{ title }} Images
            </h5>
            <button @click="hide" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-md-8">
                <div class="row g-3 align-items-center">
                  <div class="col-auto">
                    <select
                      name="category"
                      class="form-select form-select-sm"
                      v-model="categoryModel2"
                      @change="onSelectChange($event)"
                      ><option value="">Select</option>
                      <option
                        v-for="option in categoryOptions"
                        v-bind:key="option.value"
                        v-bind:value="option.value"
                      >
                        {{ option.text }}
                      </option>
                    </select>
                  </div>
                  <div class="col-auto">
                    <button
                      class="btn btn-sm btn-secondary mr-2"
                      id="fileinput-button"
                      :disabled="!categoryModel2"
                      @click="openBrowse"
                    >
                      <font-awesome-icon :icon="['fas', 'plus-square']" />
                      <span> Add files...</span>
                    </button>
                    <button
                      class="btn btn-sm btn-success mr-2"
                      :disabled="!categoryModel2"
                      @click="startAllUpload($event)"
                    >
                      <font-awesome-icon :icon="['fas', 'upload']" />
                      <span> Start upload</span>
                    </button>
                    <button
                      class="btn btn-sm btn-warning"
                      :disabled="!totalProgress"
                      @click="cancelAllUpload"
                    >
                      <font-awesome-icon :icon="['fas', 'trash']" />
                      <span> Cancel upload</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="progress-total">
                  <div class="progress">
                    <div
                      class="progress-bar bg-secondary progress-bar-striped"
                      role="progressbar"
                      :aria-valuenow="totalProgress"
                      aria-valuemin="0"
                      aria-valuemax="100"
                      :style="{ width: `${totalProgress}%` }"
                      v-bind:class="{
                        'progress-bar-animated':
                          totalProgress > 0 && totalProgress < 99.99
                            ? true
                            : false,
                        'bg-success': totalProgress > 99.99 ? true : false
                      }"
                    >
                      <span class="progress-text"
                        >{{ parseInt(totalProgress) }}%</span
                      >
                    </div>
                  </div>
                  <div
                    class="progress-size text-secondary text-center"
                    style="font-size: 10px;"
                  ></div>
                </div>
              </div>
            </div>
            <div class="row my-2">
              <div class="col">
                <vue-dropzone
                  height="100"
                  ref="galleryUploadDropZone"
                  id="dropzone"
                  class="custom-dropzone"
                  :options="config"
                  :useCustomSlot="true"
                  :include-styling="true"
                  @vdropzone-total-upload-progress="
                    vdropzoneTotalUploadProgress
                  "
                  @vdropzone-processing="vdropzoneProcessing"
                  @vdropzone-file-added="vdropzoneFileAdded"
                  @vdropzone-upload-progress="vdropzoneUploadProgress"
                  @vdropzone-canceled="vdropzoneCanceled"
                  @vdropzone-success="vdropzoneSuccess"
                  @vdropzone-mounted="vdropzoneMounted"
                >
                  <div class="dropzone-custom-content">
                    <div class="dz-default dz-message">
                      <span v-html="config.dictDefaultMessage"></span>
                    </div>
                  </div>
                </vue-dropzone>
              </div>
            </div>
            <div class="row pt-1">
              <div class="col-md-6 ">

               Uploaded Files
              </div>
              <div class="col-md-6 text-end">

                <button
                class="btn btn-sm btn-secondary"
                @click="getItems"
                :disabled="loadingSpinner"
                >
                <font-awesome-icon
                :icon="['fas', 'sync']"
                :spin="loadingSpinner"
                />
                </button> 
              </div>
            </div>
            <div class="table-responsive  pt-1">
              <table class="table table-sm table-bordered">
              <thead>
                <tr>
                   <!--<th>
                    <div class="btn-group dropright">
                      <input type="checkbox" />
                      <div
                        data-bs-toggle="dropdown" 
                        aria-expanded="false"
                        class="btn btn-sm btn-default dropdown-toggle dropdown-toggle-split"
                      >
                      
                      </div>
                      <div class="dropdown-menu">
                        <button type="button" class="dropdown-item">
                          <font-awesome-icon :icon="['fas', 'trash']" /> Delete
                        </button>
                        <button type="button" class="dropdown-item">
                          <font-awesome-icon :icon="['fas', 'plus']" /> Publish
                        </button>
                        <button type="button" class="dropdown-item">
                          <font-awesome-icon :icon="['fas', 'plus']" /> UnPublish
                        </button>
                      </div>
                    </div>
                  </th>-->

                  <th>S.NO.</th>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Category</th>
                  <!--<th>Status</th>-->
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="loadingSpinner">

                  <td colspan="8" align="center">
                    <font-awesome-icon icon="spinner" :spin="loadingSpinner" />
                  </td>
                </tr>
                <tr v-if="!loadingSpinner && galleryDatas.length==0">
                    <td colspan="8" align="center">
                      No Data found.
                    </td>
                </tr>
                <tr v-if="!loadingSpinner" v-for="(row, index) in galleryDatas" :key="row.id">
                   <!--<td><input type="checkbox" value="" /></td>-->
                  <td>{{index+1}}</td>
                  <td>{{ row.id }}</td>
                  <td> <img class="img-fluid" :src="$getPublicPath(row.media_s3_base_path+row.local_path)" width="90" height="50" /> </td>
                  <td>{{ row.file_name }}</td>
                  <td>{{ row.category }}</td>
                  <!--<td>{{ row.status }}</td>-->
                  <td>{{ row.created_at.split('T')[0] }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-danger" @click="deleteItem(row)">
                      <font-awesome-icon :icon="['fas', 'trash']" />
                    </button>
                  </td>
                </tr>
                
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal as Modal } from 'bootstrap';
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  name: "floorplanUpload",
  components: {
    vueDropzone: vue2Dropzone
  },
  props: { modalOptions: Object },
  data() {
    return {
      mediatGalleryUploadUrl: mediatGalleryUploadUrl,
      mediatGalleryListUrl: mediatGalleryListUrl,
      mediatGalleryDeleteUrl: mediatGalleryDeleteUrl,
      defaultdictDefaultMessage:
        '<p class="text-danger">Please select category first.</p>',
      categoryModel2: "",
      config: {
        previewTemplate: this.template(),
        url: mediatGalleryUploadUrl,
        headers: { "My-Awesome-Header": "header value","X-CSRF-TOKEN": window.axios.defaults.headers.common['X-CSRF-TOKEN'] },
        params:{asset_type: 'floorplan', category:''},
        maxFilesize: 20, // MB
        maxFiles: 25,
        //chunking: true,
        // chunkSize: 500, // Bytes
        thumbnailWidth: 50, // px
        thumbnailHeight: 50,
        //addRemoveLinks: true,
        acceptedFiles: ".jpg, .jpeg, .png",
        autoProcessQueue: false,
        //autoQueue: false,
        parallelUploads: 1,
        //clickable: "#fileinput-button"
        // autoQueue: false
        dictDefaultMessage: "",
        categoryModelOptionsLocal: []
      },
      images: [],
      totalProgress: 0,
      filesizeBase: 1000,
      dictFileSizeUnits: { tb: "TB", gb: "GB", mb: "MB", kb: "KB", b: "b" },
      galleryDatas: [],
      categoryOptions: [],
      showModal: false,
      //isModalOpen: false,
      title: "",
      loadingSpinner:false
    };
  },
  watch: {
    modalOptions: function(newVal) {
      this.showModal = newVal.isOpen;
      this.title = newVal.title;
      this.categoryOptions = newVal.categoryOptions;
      this.categoryModel2 = "";
      this.config.dictDefaultMessage = this.defaultdictDefaultMessage;
    },
    showModal: function() {
      //console.log("showModal local newValue, oldValue ## ", newValue, oldValue);
    }
  },
  mounted() {
    //console.log("gallery upload MediatGalleryUploadUrl",mediatGalleryUploadUrl);
    this.categoryModel2 = "";
    // this.$refs.galleryUploadDropZone.disable();
    // this.$refs.galleryUploadDropZone.removeAllFiles(true);
    // this.categoryModelOptionsLocal = this.categoryModelOptions;
    this.getItems();
  },
  created() {
    //console.log("created");
    this.categoryModel2 = "";
    this.config.dictDefaultMessage = this.defaultdictDefaultMessage;
  },
  methods: {
    getItems() {
      this.loadingSpinner = true;   
      this.axios.get(mediatGalleryListUrl,{params:{asset_type: 'floorplan'}}).then(response => {
        setTimeout(() => {
        this.loadingSpinner = false; 
        },1000);
        this.galleryDatas = response.data.data;
      }).catch(e => {
        this.loadingSpinner = false; 
        console.log('error',e);
      });
    },
    deleteItem:function (item) {
      console.log('deleteItem ',item.id);  
      if(confirm('Are you sure want to delete?')){
        this.loadingSpinner = true;          
        this.axios({method: 'delete', url: mediatGalleryDeleteUrl+'/'+item.id}).then(response => {
          setTimeout(() => {
            this.loadingSpinner = false;
            this.getItems();
          },1000);
        }).catch(e => {
          this.loadingSpinner = false; 
          console.log('error',e);
        });
      }
    },
    show() {
      this.showModal = true;
      setTimeout(() => {
        const galleryUploadModal = new Modal(document.getElementById('galleryUploadModal'), {
        keyboard: false,
        backdrop: "static"
        });
        galleryUploadModal.show();
      });
    },
    hide() {
      this.showModal = false;

      this.$emit("close");
    },
    vdropzoneMounted() {
      //console.log("vdropzoneMounted ");
      this.$refs.galleryUploadDropZone.disable();
      this.$refs.galleryUploadDropZone.removeAllFiles(true);
      this.config.dictDefaultMessage = this.defaultdictDefaultMessage;
    },
    // uploadGetAcceptedFiles() {
    //   const self = this;
    //   if (self.$refs) {
    //     // console.log(
    //     //   "this.$refs.galleryUploadDropZone.getAcceptedFiles().length",
    //     //   self.$refs.galleryUploadDropZone.getAcceptedFiles().length
    //     // );
    //     return self.$refs.galleryUploadDropZone.getAcceptedFiles().length > 0;
    //   } else return true;
    // },
    onSelectChange(event) {
      if (event) {
        event.preventDefault();
      }
      //console.log("onSelectChange", event.target.value, this.categoryModel2);
      this.config.params.category = event.target.value; 
      if (this.categoryModel2) {
        //Click or Drag and Drop to upload
        this.config.dictDefaultMessage = "Drop files here to upload";
        this.$refs.galleryUploadDropZone.enable();
      } else {
        this.config.dictDefaultMessage = this.defaultdictDefaultMessage;
        this.$refs.galleryUploadDropZone.disable();
      }
    },
    openBrowse() {
      //console.log("openBrowse");
      this.$refs.galleryUploadDropZone.$el.click();
    },
    enableUpload() {
      //console.log("enableUpload");
      this.$refs.galleryUploadDropZone.enable();
    },
    startAllUpload() {
      //console.log("startAllUpload");
      this.$refs.galleryUploadDropZone.processQueue();
    },
    cancelAllUpload() {
      //console.log("cancelAllUpload");
      this.$refs.galleryUploadDropZone.removeAllFiles(true);
      this.totalProgress = 0;
    },
    vdropzoneCanceled() {
      this.totalProgress = 0;
    },
    vdropzoneSuccess(file) {
      //console.log("vdropzoneSuccess", response);
      let self = this;
      let getQueuedFiles = self.$refs.galleryUploadDropZone.getQueuedFiles()
        .length;
      //console.log("getQueuedFiles", getQueuedFiles);

      setTimeout(() => {
        if (getQueuedFiles) {
          file.previewElement.remove();
        } else {
          self.$refs.galleryUploadDropZone.removeAllFiles(false);
          self.totalProgress = 0;
        }
        this.getItems();
      }, 3000);
    },
    prettySize(bytes, separator = "", postFix = "") {
      if (bytes) {
        const sizes = ["Bytes", "KB", "MB", "GB", "TB"];
        const i = Math.min(
          parseInt(Math.floor(Math.log(bytes) / Math.log(1024)).toString(), 10),
          sizes.length - 1
        );
        return `${(bytes / 1024 ** i).toFixed(i ? 1 : 0)}${separator}${
          sizes[i]
        }${postFix}`;
      }
      return "";
    },

    prettySize2(size) {
      let selectedSize = 0;
      let selectedUnit = "b";
      if (size > 0) {
        let units = ["tb", "gb", "mb", "kb", "b"];
        for (let i = 0; i < units.length; i++) {
          let unit = units[i];
          let cutoff = Math.pow(this.filesizeBase, 4 - i) / 10;
          if (size >= cutoff) {
            selectedSize = size / Math.pow(this.filesizeBase, 4 - i);
            selectedUnit = unit;
            break;
          }
        }
        selectedSize = Math.round(10 * selectedSize) / 10; // Cutting of digits
      }
      return `${selectedSize} - ${this.dictFileSizeUnits[selectedUnit]}`;
    },
    vdropzoneUploadProgress(file, progress, bytesSent) {
      //console.log("vdropzoneUploadProgress", progress, bytesSent);
      if (file.previewElement) {
        var progressElement = file.previewElement.querySelector(
          "[data-dz-uploadprogress]"
        );
        progressElement.style.width = progress + "%";
        progressElement.querySelector(".progress-text").textContent =
          parseInt(progress) + "% ";
        file.previewElement.querySelector(
          ".progress-info .progress-size"
        ).textContent =
          this.prettySize(bytesSent) + " / " + this.prettySize(file.size);
        if (progress == 100) {
          progressElement.classList.remove(
            "progress-bar-animated",
            //"progress-bar-striped",
            "bg-secondary"
          );
          progressElement.classList.add("bg-success");
        }
      }
    },
    vdropzoneTotalUploadProgress(totaluploadprogress) {
      // console.log(
      //   "vdropzoneTotalUploadProgress: ",
      //   totaluploadprogress,
      //   "totalBytes : ",
      //   totalBytes,
      //   "totalBytesSent :",
      //   totalBytesSent
      // );
      this.totalProgress = totaluploadprogress;
      /*document.querySelector(".progress-total .progress-size").textContent =
        this.prettySize2(totalBytesSent) + " / " + this.prettySize2(totalBytes);*/
    },
    vdropzoneProcessing() {
      //console.log("vdropzoneProcessing", file);
      // this.$refs.dropzone.getAcceptedFiles().forEach(f => this.$refs.dropzone.enqueueFile(f));
      // this.$refs.dropzone.dropzone.enqueueFile(f)
    },
    vdropzoneFileAdded() {
      //console.log("vdropzoneFileAdded");
      // this.$refs.galleryUploadDropZone
      //   .getAcceptedFiles()
      //   .forEach(f => (this.dropzoneTotalFilesize += f.size));
    },
    template: function() {
      return `
            <div id="previews-gallery" class="file-row">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th width="10%">Preview</th>
                        <th width="50%">Name</th>
                        <th width="10%">Size</th>
                        <th width="20%">Progress</th>
                        <th width="10%" style="text-align: right;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span class="preview"><img data-dz-thumbnail/></span>
                        </td>
                        <td>
                            <p class="mb-0 name" data-dz-name></p>
                            <p class="error text-danger" data-dz-errormessage></p>
                        </td>
                        <td>
                            <p class="size" data-dz-size></p>
                        </td>
                        <td>
                            <div class="progress-info">
                              <div class="progress">
                                  <div 
                                  class="progress-bar progress-bar-striped bg-secondary progress-bar-animated" 
                                  role="progressbar" 
                                  aria-valuenow="0"
                                  aria-valuemin="0"
                                  aria-valuemax="100"
                                  style="width:0%;"
                                  data-dz-uploadprogress
                                  >
                                    <span class="progress-text"></span>
                                  </div>                                  
                              </div>
                              <div class="progress-size text-secondary text-center" style="font-size: 10px;"></div>
                            </div>
                        </td>
                        <td align="right">                          
                            <button
                                data-dz-remove
                                class="btn btn-sm btn-warning text-white cancel"
                            >
                                <font-awesome-icon :icon="['fas', 'ban']" />
                                cancel
                            </button>
                            <button data-dz-remove class="btn btn-sm btn-danger delete">
                                <font-awesome-icon :icon="['fas', 'trash']" />
                                delete
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                 <style>
                    /* Hide the progress bar when finished */
                    #previews .file-row.dz-success .progress {
                      opacity: 0;
                      transition: opacity 0.3s linear;
                    }
                    /* Hide the delete button initially */
                    /*dz-image-preview dz-processing dz-success dz-complete*/                  
                    /*
                    #dropzone .file-row.dz-success .progress {
                      opacity: 0 !important;
                      transition: opacity 0.3s linear !important;
                      display: none;
                    }
                    
                    #dropzone .file-row .progress-done {
                      display: none;
                    }
                    #dropzone .file-row.dz-success .progress-done {
                      display: block;
                      opacity: 1 !important;
                      transition: opacity 0.3s linear !important;
                    }*/
                    #dropzone .file-row .delete {
                      display: none;
                    }
                    /* Hide the start and cancel buttons and show the delete button */
                    #dropzone .file-row.dz-success .start,
                    #dropzone .file-row.dz-success .cancel {
                      display: none;
                    }
                    #dropzone .file-row.dz-success .delete {
                      display: block;
                      opacity: 0.5;
                      transition: opacity 0.3s linear;
                    }
                  </style>
            </div>           
            `;
    }
  }
};
</script>

<style scoped>
/* style here */
.custom-dropzone {
  min-height: 100px !important;
}
.dropzone .dz-message {
  margin: 1em 0 !important;
}
</style>
