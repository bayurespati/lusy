import {store} from './store';

export default {

    getIndexOfGallery(galleryId) {
        return _.findIndex(store.state.gallery, function (galleri) {
            return galleri.id === galleryId;
        });
    },
}