function swap_id(id1, id2) {
    el1 = document.getElementById(id1);
    el2 = document.getElementById(id2);

    tmp = el1.id;
    el1.id = el2.id;
    el2.id = tmp;
};
