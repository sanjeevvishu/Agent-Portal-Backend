<template>
  <section>
    <div class="row mt-2">
      <div class="col-md-6"><strong>Floorplan List</strong></div>
      <div class="col-md-6 text-end">
        <button
          @click="openGaleryNViewsModal('Floorplan')"
          :disabled="galleryViewModalShowParent"
          type="button"
          class="btn btn-sm btn-secondary mr-2"
        >
          <font-awesome-icon :icon="['fas', 'upload']" /> Upload Images
        </button>
        <button
          class="btn btn-sm btn-secondary"
          @click="getItems"
          :disabled="refreshGalleriesSpinner"
        >
          <font-awesome-icon
            :icon="['fas', 'sync']"
            :spin="refreshGalleriesSpinner"
          />
        </button>
      </div>
    </div>
    <hr />
    <div
      v-if="refreshGalleriesSpinner"
      class="row text-center justify-content-center"
    >
      <div class="col mt-2">
        <font-awesome-icon icon="spinner" :spin="refreshGalleriesSpinner" />
      </div>
    </div>
    <div
      v-if="!refreshGalleriesSpinner"
      class="row text-center justify-content-center"
    >
      <div
        class="col-md-3 mt-2"
        v-for="(row, groupName, index) in galleryImages"
        :key="index"
      >
        <div class="card box-shadow">
          <a
            href="javascript:void(0)"
            @click="openModal(groupName, row)"
            data-toggle="modal"
            data-target="#galleryModal"
            ><progressive-img
              :src="$getPublicPath(row[0].media_s3_base_path+row[0].local_path)"
              :placeholder="$getPublicPath(row[0].media_s3_base_path+row[0].local_path)"
              :imageCustomClass="imgfluid"
              :blur="30"
            />
            </a
          >
            <div class="card-body">
              <h6 class="card-title mb-0">
                <span>{{ groupName }}</span>
              </h6>
            </div>
        </div>
      </div>
    </div>
    <!-- Modal for gallery upload -->
    <FloorplanUpload
      ref="galleryUploadModal"
      @close="galleryViewModalShowParent = false"
      v-bind:modalOptions="galleryUploadModalOptions"
    />
    <!--gallery-->
    <FloorplanCarousel
      ref="modal2"
      :images="dynamicGalleryData"
      :title="dynamicGalleryTitle"
    />
  </section>
</template>
<script>
export default {
  name: "FloorplanManager",
  components: {
    FloorplanUpload: () =>
      import(
        /* webpackChunkName: "FloorplanUpload" */ "./FloorplanUpload.vue"
      ),
    FloorplanCarousel: () =>
      import(
        /* webpackChunkName: "FloorplanCarousel" */ "./FloorplanCarousel.vue"
      )
  },
  data() {
    return {
      imgfluid: "img-fluid thumbnail-img",
      galleryImages: [],
      refreshGalleriesSpinner: true,
      dynamicGalleryData: [],
      dynamicGalleryTitle: "Loading...",
      galleryCategoryModelOptions: [
        { text: "1+1", value: "1+1" },
        { text: "2+1", value: "2+1" },
        { text: "3+1", value: "3+1" },
        { text: "4+1", value: "4+1" },
        { text: "5+1", value: "5+1" },
        { text: "6+1", value: "6+1" },
        { text: "7+1", value: "7+1" },
        { text: "8+1", value: "8+1" },
        { text: "9+1", value: "9+1" },
        { text: "Office", value: "office" },
        { text: "Shop", value: "shop" },
        
      ],
      galleryViewModalShowParent: false,
      galleryUploadModalOptions: {}
    };
  },
  watch: {
    galleryViewModalShowParent: function() {
      // console.log(
      //   "galleryViewModalShowParent newValue, oldValue ## ",
      //   newValue,
      //   oldValue
      // );
    }
  },
  mounted() {
    let self = this;
    self.refreshGalleriesSpinner = true;
    setTimeout(function() {
      self.refreshGalleriesSpinner = false;
    }, 2000);
    this.getItems();
  },
  methods: {
     groupBy(xs, key){
        return xs.reduce(function(rv, x) {
          (rv[x[key]] = rv[x[key]] || []).push(x);
          return rv;
        }, {});
     },
    getItems() {
      this.refreshGalleriesSpinner = true;   
      this.axios.get(mediatGalleryListUrl,{params:{asset_type: 'floorplan'}}).then(response => {
        setTimeout(() => {
        this.refreshGalleriesSpinner = false; 
        },1000);
        let groupedGalleryImages  = this.groupBy(response.data.data,'category');
        this.galleryImages = groupedGalleryImages;
        console.log("groupedFloorplanImages ", groupedGalleryImages);
        //this.galleryImages = response.data.data;
      }).catch(e => {
        this.refreshGalleriesSpinner = false; 
        console.log('error',e);
      });
    },
    openGaleryNViewsModal(title) {
      this.galleryViewModalShowParent = true;

      this.galleryUploadModalOptions = Object.assign(
        {},
        {
          title: title,
          isOpen: this.galleryViewModalShowParent,
          categoryOptions:
            title == "Layouts"
              ? this.galleryLayoutCategoryModelOptions
              : this.galleryCategoryModelOptions
        }
      );
      this.$refs.galleryUploadModal.show();
    },
    openModal(title, images) {
      //console.log("openModal ", title);
      this.dynamicGalleryData = images;
      this.dynamicGalleryTitle = title;
      this.$refs["modal2"].show();
    },
    refreshGalleries() {
      //console.log("refreshGalleries");
      let self = this;
      self.refreshGalleriesSpinner = true;
      setTimeout(function() {
        self.refreshGalleriesSpinner = false;
      }, 1000);
    }
  }
};
</script>
