import {store} from './store';

export default {

    getIndexOfGalleryShow(galleryId) {
        return _.findIndex(store.state.galleryShow, function (gallery) {
            return gallery.id === galleryId;
        });
    },


    getIndexOfGalleryHide(galleryId) {
        return _.findIndex(store.state.galleryHide, function (gallery) {
            return gallery.id === galleryId;
        });
    },
}