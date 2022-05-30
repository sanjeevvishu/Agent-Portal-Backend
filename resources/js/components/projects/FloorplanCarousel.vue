<template>
  <section>
    <!-- Modal -->
    <div
      v-if="showModal"
      class="modal fade"
      id="galleryModal"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
      data-backdrop="static"
      data-keyboard="false"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ localTitle }} Gallery
            </h5>
             <button @click="hide" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" 
                data-bs-target="#carouselExampleIndicators"  
                v-for="(image, index) in localImages"
                  :key="image.id"
                  :class="[activeImage == index ? 'active' : '']"
                  :data-bs-slide-to="index" 
                 
                  @click="activateImage(index)"
                  ></button>
               <!-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>-->
              </div>
              <div class="carousel-inner">
                <div v-for="(image, index) in localImages"
                    :key="image.id"
                    :class="[
                      'carousel-item',
                      activeImage == index ? 'active' : ''
                    ]"
                    @click="activateImage(index)"
                    >
                  <img :src="$getPublicPath(image.media_s3_base_path+image.local_path)" class="d-block w-100" alt="...">
                </div>
              
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <div v-if="progressLoader" class="text-center">
              <p>Loading...</p>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { Modal as Modal } from 'bootstrap';
export default {
  name: "FloorplanCarousel",
  props: {
    images: {
      type: Array,
      required: true
    },
    title: {
      type: String,
      default: "Opps!"
    }
  },
  data() {
    return {
      showModal: false,
      localTitle: null,
      localImages: [],
      activeImage: 0,
      progressLoader: true
    };
  },
  watch: {
    images: function(newValue) {
      // console.log(
      //   "images newValue, oldValue",
      //   this.progressLoader,
      //   newValue,
      //   oldValue
      // );
      // this.localTitle = title;
      this.localImages = newValue;
    },
    title: function(newValue) {
      //console.log("title newValue, oldValue", newValue, oldValue);
      this.localTitle = newValue;
    }
  },
  computed: {
    currentImage() {
      return this.images[this.activeImage].big;
    }
  },
  beforeMount() {
    //console.log("in GalleryCarousel beforeMount", this.title, this.images);
  },
  beforeUpdate() {
    //console.log("in GalleryCarousel beforeUpdate", this.title, this.images);
    const that = this;
    setTimeout(function() {
      that.$nextTick().then(() => {
        that.progressLoader = false;
      });
    }, 2000);
  },
  mounted() {
    //console.log("in GalleryCarousel mounted", this.title, this.images);
    
     
        
  },
  methods: {
    loadGallery() {
      //console.log("in GalleryCarousel computed loadGallery **");
    },
    show() {
      this.showModal = true;

       setTimeout(() => {
        const galleryUploadModal2 = new Modal(document.getElementById('galleryModal'), {
        keyboard: false,
        backdrop: "static"
        });
        galleryUploadModal2.show();
      },100);

      //console.log("in GalleryCarousel show", this.title, this.images);
      this.$nextTick().then(() => {
        this.progressLoader = false;
      });
    },
    hide() {
      this.showModal = false;
      //this.localImages = [];
      //console.log("in GalleryCarousel hide", this.images);
    },
    // nextImage() {
    //   var active = this.activeImage + 1;
    //   if (active >= this.images.length) {
    //     active = 0;
    //   }
    //   this.activateImage(active);
    // },
    // prevImage() {
    //   var active = this.activeImage - 1;
    //   if (active < 0) {
    //     active = this.images.length - 1;
    //   }
    //   this.activateImage(active);
    // },
    activateImage(imageIndex) {
      this.activeImage = imageIndex;
    }
  }
};
</script>
<style scoped>
/* style here */
.carousel-control-prev-icon,.carousel-control-next-icon {
  background-color: #444 !important;;
}
</style>