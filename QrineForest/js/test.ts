function x(n: number) {
    return 100 * n;
}

class X {
    private num = 100;

    public abc(f: (n: number) => boolean): boolean {
        return f(123);
    }

}