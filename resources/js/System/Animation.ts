import { AnimationMixer, Object3D } from "three";

export default class Animation {
  private mixers: Map<Object3D, AnimationMixer>;

  constructor() {
    this.mixers = new Map<Object3D, AnimationMixer>();
  }

  // Tilføj en ny mixer for en model
  public addAnimation(model: Object3D): AnimationMixer {
    const mixer = new AnimationMixer(model);
    this.mixers.set(model, mixer);
    return mixer;
  }

  // Opdater alle animation-mixers
  public updateAnimations(deltaTime: number): void {
    this.mixers.forEach((mixer) => {
      mixer.update(deltaTime);
    });
  }

  // Hent en mixer for en specifik model
  public getMixer(model: Object3D): AnimationMixer | undefined {
    return this.mixers.get(model);
  }
}

