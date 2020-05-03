function BinaryTree() {
    this.root = null;
}

function Node(value) {
    let _this = this;
    _this.value = value;
    _this.left = null;
    _this.right = null;
}

BinaryTree.prototype.insert = function(value) {
    let _this = this;
    let node = new Node(value);
    let insertNode = function(root, node) {
        if (root.value > node.value) {
            if (root.left === null) {
                root.left = node;
            } else {
                insertNode(root.left, node);
            }
        } else if (root.value < node.value) {
            if (root.right === null) {
                root.right = node;
            } else {
                insertNode(root.right, node);
            }
        }
    };

    if (_this.root === null) {
        _this.root = node;
    } else {
        insertNode(_this.root, node);
    }
};

// 中序遍历
BinaryTree.prototype.inOrderTraverse = function(callback) {
    let inOrderTraverseNode = function(node, callback) {
        if (node !== null) {
            inOrderTraverseNode(node.left, callback);
            callback(node.value);
            inOrderTraverseNode(node.right, callback);
        }
    };
    inOrderTraverseNode(this.root, callback);
};

// 前序遍历
BinaryTree.prototype.preOrderTraverse = function(callback) {
    let preOrderTraverseNode = function(node, callback) {
        if (node !== null) {
            callback(node.value);
            preOrderTraverseNode(node.left, callback);
            preOrderTraverseNode(node.right, callback);
        }
    };
    preOrderTraverseNode(this.root, callback);
};

// 后序遍历
BinaryTree.prototype.postOrderTraverse = function(callback) {
    let postOrderTraverseNode = function(node, callback) {
        if (node !== null) {
            postOrderTraverseNode(node.left, callback);
            postOrderTraverseNode(node.right, callback);
            callback(node.value);
        }
    };
    postOrderTraverseNode(this.root, callback);
};

BinaryTree.prototype.min = function() {
    let minNode = function(node) {
        if (node !== null) {
            while (node.left !== null) {
                node = node.left;
            }
            return node.value;
        } else {
            return null;
        }
    };
    return minNode(this.root);
};

BinaryTree.prototype.max = function() {
    let maxNode = function(node) {
        if (node !== null) {
            while (node.right !== null) {
                node = node.right;
            }
            return node.value;
        } else {
            return null;
        }
    };
    return maxNode(this.root);
};

BinaryTree.prototype.hasValue = function(value) {
    let hasValueNode = function(node, value) {
        if (node === null) {
            return false;
        }
        if (node.value > value) {
            return hasValueNode(node.left, value);
        } else if (node.value < value) {
            return hasValueNode(node.right, value);
        } else {
            return true;
        }
    };
    return hasValueNode(this.root, value);
};

BinaryTree.prototype.remove = function(value) {
    let findMinNode = function(node) {
        if (node !== null) {
            while (node.left !== null) {
                node = node.left;
            }
            return node.value;
        } else {
            return null;
        }
    };

    let removeNode = function(node, value) {
        if (node === null) {
            return null;
        } else if (node.value > value) {
            node.left = removeNode(node.left, value);
            return node;
        } else if (node.value < value) {
            node.right = removeNode(node.right, value);
            return node;
        } else {
            if (node.left === null && node.right === null) {
                node = null;
                return node;
            }
            if (node.left === null) {
                node = node.right;
                return node;
            } else if (node.right == null) {
                node = node.left;
                return node;
            }

            let aux = findMinNode(node.right);
            node.value = aux.value;
            node.right = removeNode(node.right, aux.value);
            return node;
        }
    };
    return removeNode(this.root, value);
};

let bt = new BinaryTree();
let nodes = [12, 13, 5, 8, 19, 23, 78, 45, 41, 52, 64, 85];
nodes.forEach(function(v) {
    bt.insert(v);
});

let inOrderNodes = [];
bt.inOrderTraverse(function(value) {
    inOrderNodes.push(value);
});

let preOrderNodes = [];
bt.preOrderTraverse(function(value) {
    preOrderNodes.push(value);
});

let postOrderNodes = [];
bt.postOrderTraverse(function(value) {
    postOrderNodes.push(value);
});

console.log(bt);
console.log(nodes);
console.log(inOrderNodes);
console.log(preOrderNodes);
console.log(postOrderNodes);
console.log("min : " + bt.min());
console.log("max : " + bt.max());
console.log("has 3 : " + bt.hasValue(3));
console.log("has 41 : " + bt.hasValue(41));

console.log(bt.remove(41));
let dealInOrderNodes = [];
bt.inOrderTraverse(function(value) {
    dealInOrderNodes.push(value);
});
console.log(dealInOrderNodes);
