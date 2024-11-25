import { Scene, Object3D } from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader';

export class Loader {
  loader: GLTFLoader;

  constructor(scene: Scene) {
    this.loader = new GLTFLoader();

    // Optionally, preload assets
    // this.loader.load('path/to/model.gltf', (gltf) => {
    //   scene.add(gltf.scene);
    // });
  }

  loadModel(path: string, onLoad: (model: Object3D) => void) {
    this.loader.load(path, (gltf) => {
      onLoad(gltf.scene);
    });
  }
}
