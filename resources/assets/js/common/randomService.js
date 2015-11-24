/*@ngInject*/
export default function randomService(){
    return {
        string
    };
}

function string(length = 5){
    return (new Date() * Math.random()).toString(36).slice(2, length);
}