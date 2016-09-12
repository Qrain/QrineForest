function x(n) {
    return 100 * n;
}
var X = (function () {
    function X() {
        this.num = 100;
    }
    X.prototype.abc = function (f) {
        return f(123);
    };
    return X;
}());
