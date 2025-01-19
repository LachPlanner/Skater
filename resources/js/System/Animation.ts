import { AnimationClip, AnimationMixer, Object3D, LoopOnce } from "three";

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

  public playAnimation(model: Object3D, onStart?: () => void): void {
    const mixer = this.getMixer(model);
    if (!mixer) {
      console.warn("Mixer not found for model:", model);
      return;
    }
  
    const animations = model.userData.animations as AnimationClip[];
    if (!animations || animations.length === 0) {
      console.warn("No animations found for model:", model);
      return;
    }
  
    const clip = animations[0];
    const action = mixer.clipAction(clip);
  
    if (onStart) {
      setTimeout(() => {
        onStart();
      }, 650);
    }
  
    action.reset().play();
    action.clampWhenFinished = true;
    action.loop = LoopOnce;
  }
}

