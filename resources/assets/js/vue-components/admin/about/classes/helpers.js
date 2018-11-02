import {store} from './store';

export default {

    getIndexOfClass(classId) {
        return _.findIndex(store.state.classes, function (singleClass) {
            return singleClass.id === classId;
        });
    },
}