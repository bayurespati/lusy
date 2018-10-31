import {store} from './store';

export default {

    getIndexOfImageSlider(imageId) {
        return _.findIndex(store.state.imageSliders, function (imageSlider) {
            return imageSlider.id === imageId;
        });
    },
}