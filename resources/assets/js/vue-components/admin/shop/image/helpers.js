import {store} from './store';

export default {

    getIndexOfImageList(imageId) {
        return _.findIndex(store.state.imageList, function (image) {
            return image.id === imageId;
        });
    },
}